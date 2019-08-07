<template>
    <form @submit.prevent="formSubmit">
        <div class="form-group">
            <label for="sender_id">From</label>
            <user-component id="sender_id" v-model="message.sender_id" :edit="edit"></user-component>
        </div>

        <div class="form-group">
            <label for="recipient_id">To</label>
            <user-component id="recipient_id" v-model="message.recipient_id" name="recipient_id" :edit="edit"></user-component>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input :readonly="!edit" type="text" class="form-control" id="subject" v-model="message.subject" placeholder="Enter subject">
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <editor-component id="message" v-model="message.message" :edit="edit"></editor-component>
        </div>

        <button class="btn btn-success float-right" @click.prevent="submitForm">{{ buttonText | capitalize }}</button>
    </form>
</template>

<script>
    export default {
        name: "MessageComponent",
        props: {
            value: {
                type: Object,
                default() {
                    return {}
                }
            },
            action: {
                type: String,
                default() {
                    return 'create';
                }
            }
        },
        data() {
            return {
                message: this.value,
                edit: this.action !== 'show',
                errors: [],
                storage_action: this.action
            }
        },
        methods: {
            validate() {
                this.errors = [];
                if (!this.message.recipient_id || !this.message.sender_id) {
                    this.errors.push({message: 'you must select a sender and receiver.'});
                }

                if (this.message.recipient_id === this.message.sender_id) {
                    this.errors.push({message: 'Sender and receiver cannot be the same.'});
                }

                if (!this.message.subject) {
                    this.errors.push({message: 'Please provide a subject.'});
                }

                if (!this.message.message) {
                    this.errors.push({message: 'Please provide a message.'});
                }

                this.errors.forEach(error => {

                    Vue.$toast.open({
                        message: error.message,
                        type: 'error'
                    });
                });

                return this.errors.length === 0;
            },
            updateMessage() {
                axios.patch('/messages/' + this.message.id, this.message)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            createMessage() {
                axios.post('/messages', this.message)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            updateMode() {
                this.edit = true;
                this.storage_action = 'update';
                window.history.pushState("object or string", "Title", '/messages/'+this.message.id+'/edit');
            },
            submitForm() {
                if (!this.validate()) {
                    return false;
                } else if (this.storage_action === 'create') {
                    this.createMessage();
                    let timer = setTimeout(() => {
                        window.location.href = '/messages'
                    }, 3000);
                } else if (this.storage_action === 'update') {
                    this.updateMessage();
                } else if (this.storage_action === 'show') {
                    this.updateMode()
                }
            }
        },
        computed: {
            buttonText() {
                if (this.storage_action === 'show') {
                    return 'edit';
                }
                return this.storage_action;
            }
        }
    }
</script>

<style scoped>

</style>
