<template>
    <div class="post-trend-body">
        <div class="ui grid post-trend-header-container">
            <div class="left floated eight wide column post-trend-header">
                Post trends
            </div>
            <div class="right floated eight wide column post-trend-filter mtop-5">
                <div class="right-float ui dropdown" tabindex="0">
                    <div class="text fs-16">This month</div>
                    <i class="fal fa-angle-down icon"></i>
                    <div class="menu transition hidden dropdown-menu" tabindex="-1">
                        <div class="item fs-16 pr-50 bb-1">This week</div>
                        <div class="item fs-16 pr-50">This month</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui grid">
            <div class="eight wide column">
                <div class="perform-title bold-font mtop-15">
                    Best performing
                </div>
                <div class="card mtop-10">
                    <div class="image">
                        <img src="images/image1.png">
                    </div>
                    <div class="extra">
                        <div class="mtop-5 fs-12">
                            Aug 15, 2019
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            120
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-10">
                            <i class="comment icon"></i>
                            23
                        </div>
                    </div>
                </div>
            </div>
            <div class="eight wide column">
                <div class="perform-title bold-font mtop-15">
                    Worst performing
                </div>
                <div class="card mtop-10">
                    <div class="image">
                        <img src="images/image2.png">
                    </div>
                    <div class="extra">
                        <div class="mtop-5 fs-12">
                            Aug 1, 2019
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            12
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-10">
                            <i class="comment icon"></i>
                            0
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                posts: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/posts')
                .then(function (resp) {
                    // Initializing dropdown menu
                    $('.ui.dropdown')
                        .dropdown();

                    app.posts = resp.data;
                    console.log('posts', app.posts);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load posts");
                });
        },
        methods: {
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.delete('/api/v1/posts/' + id)
                        .then(function (resp) {
                            app.posts.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert("Could not delete post");
                        });
                }
            }
        }
    }
</script>
