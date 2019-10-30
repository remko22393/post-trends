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
                        <img v-bind:src="posts['best_post']['thumbnail']">
                    </div>
                    <div class="extra">
                        <div class="mtop-5 fs-12">
                            {{ posts['best_post']['taken_at'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            {{ posts['best_post']['likes_cnt'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-10">
                            <i class="comment icon"></i>
                            {{ posts['best_post']['comments_cnt'] }}
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
                        <img v-bind:src="posts['worst_post']['thumbnail']">
                    </div>
                    <div class="extra">
                        <div class="mtop-5 fs-12">
                            {{ posts['worst_post']['taken_at'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            {{ posts['worst_post']['likes_cnt'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-10">
                            <i class="comment icon"></i>
                            {{ posts['worst_post']['comments_cnt'] }}
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

        }
    }
</script>
