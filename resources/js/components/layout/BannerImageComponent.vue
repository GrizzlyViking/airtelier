<template>
    <div class="banner_background" :style="background_image">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="font-weight-light">
                        {{ title }}
                    </h1>
                    <p class="lead">{{ subTitle }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "BannerImageComponent",
        props: {
            img: {
                type: String,
                default() {
                    return 'storage/images/DSC_0011.jpg';
                }
            },
            title: {
                type: String
            },
            subTitle: {
                type: String
            }
        },
        computed: {
            background_image() {
                return {
                    'background-image' : 'url('+this.img+')'
                }
            }
        }
    }
</script>

<style scoped>
    .banner_background {
        height: 100vh;
        min-height: 500px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
