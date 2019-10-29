<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Create new post</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Post name</label>
                            <input type="text" v-model="post.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Post address</label>
                            <input type="text" v-model="post.address" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Post website</label>
                            <input type="text" v-model="post.website" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label class="control-label">Post email</label>
                            <input type="text" v-model="post.email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.postId = id;
            axios.get('/api/v1/posts/' + id)
                .then(function (resp) {
                    app.post = resp.data;
                })
                .catch(function () {
                    alert("Could not load your post")
                });
        },
        data: function () {
            return {
                postId: null,
                post: {
                    name: '',
                    address: '',
                    website: '',
                    email: '',
                }
            }
        },
        methods: {
            saveForm() {
                event.preventDefault();
                var app = this;
                var newCompany = app.post;
                axios.patch('/api/v1/posts/' + app.postId, newCompany)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your post");
                    });
            }
        }
    }
</script>
