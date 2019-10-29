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
        data: function () {
            return {
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
                var newPost = app.post;
                axios.post('/api/v1/posts', newPost)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your post");
                    });
            }
        }
    }
</script>
