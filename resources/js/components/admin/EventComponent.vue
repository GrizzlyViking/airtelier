<template>
    <form>
        <div class="form-group">
            <label for="owner_id">Author</label>
            <user-component id="owner_id" v-model="event.owner_id" :edit="edit"></user-component>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" v-model="event.title" placeholder="Enter title">
        </div>

        <div class="form-group">
            <label for="sub_title">Sub title</label>
            <input type="text" class="form-control" id="sub_title" name="sub_title" placeholder="Enter sub_title">
        </div>

        <div class="form-group">
            <label for="description">Description of event</label>
            <editor-component v-model="event.description" :edit="edit"></editor-component>
        </div>

        <hr class="mb-4 mt-5">

        <div class="form-group">
            <label for="frequency">Scheduling</label>
            <scheduling-component id="frequency" v-model="event.schedule"></scheduling-component>
        </div>

        <hr class="mb-4 mt-5">

        <div class="form-group">
            <meta-component v-model="event.meta" :edit="edit"></meta-component>
        </div>

        <button class="btn btn-success float-right" @click.prevent="submitForm">{{ buttonText | capitalize }}</button>
    </form>
</template>

<script>
    export default {
        name: "EventComponent",
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
                edit: this.action !== 'show',
                errors: [],
                label: 'name',
                storage_action: this.action,
                event: this.value
            }
        },
        methods: {
            validate() {
                this.errors = [];
                if (!this.event.owner_id) {
                    this.errors.push({event: 'you must select an owner.'});
                }

                this.errors.forEach(error => {

                    Vue.$toast.open({
                        message: error.event,
                        type: 'error'
                    });
                });

                return this.errors.length === 0;
            },
            updateEvent() {
                axios.patch('/events/' + this.event.id, this.event)
                    .then(response => {
                        this.showMode();
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            createEvent() {
                axios.post('/events', this.event)
                    .then(response => {
                        this.showMode();
                    })
                    .catch(error => { console.log(error.response.data)})
            },
            updateMode() {
                this.edit = true;
                this.storage_action = 'update';
                window.history.pushState("object or string", "Title", '/events/'+this.event.id+'/edit');
            },
            showMode() {
                this.edit = false;
                this.storage_action = 'show';
                window.history.pushState("object or string", "Title", '/events/'+this.event.id);
            },
            submitForm() {
                this.event.evented_id = this.event.evented.id;

                if (!this.validate()) {
                    return false;
                } else if (this.storage_action === 'create') {
                    this.createEvent();
                } else if (this.storage_action === 'update') {
                    this.updateEvent();
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
