<template>
    <div class="post-trend-body">
        <loading :active.sync="isLoading"
                 :is-full-page="true"></loading>
        <div class="ui grid post-trend-header-container">
            <div class="left floated eight wide column post-trend-header">
                Post trends
            </div>
            <div class="right floated eight wide column post-trend-filter mtop-5">
                <div class="right-float ui dropdown" tabindex="0">
                    <div class="text fs-16">This week</div>
                    <i class="fal fa-angle-down icon"></i>
                    <div class="menu transition hidden dropdown-menu" tabindex="-1">
                        <div class="item fs-16 pr-50 bb-1" v-on:click="searchPost('1w')">This week</div>
                        <div class="item fs-16 pr-50" v-on:click="searchPost('1m')">This month</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui grid" v-if="posts.hasOwnProperty('best_post')">
            <div class="eight wide column">
                <div class="perform-title bold-font mtop-15">
                    Best performing
                </div>
                <div class="card mtop-10">
                    <div class="image">
                        <img v-bind:src="posts['best_post']['thumbnail']">
                    </div>
                    <div class="extra">
                        <div class="mtop-10 fs-12">
                            {{ posts['best_post']['taken_at'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            {{ posts['best_post']['likes_cnt'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-20">
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
                        <div class="mtop-10 fs-12">
                            {{ posts['worst_post']['taken_at'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block">
                            <i class="heart icon"></i>
                            {{ posts['worst_post']['likes_cnt'] }}
                        </div>
                        <div class="ui icon fs-16 mtop-5 inline-block ml-20">
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
    // Import component
    import Loading from 'vue-loading-overlay';
    // Import stylesheet
    import 'vue-loading-overlay/dist/vue-loading.css';

    export default {
        data: function () {
            return {
                posts: [],
                currentSearchTerm: '1w',
                isLoading: false,
            }
        },
        components: {
            Loading
        },
        mounted() {
            var app = this;

            app.isLoading = true;
            axios.post('/api/v1/posts', {period: app.currentSearchTerm})
                .then(function (resp) {
                    // Initializing dropdown menu
                    $('.ui.dropdown')
                        .dropdown();

                    app.posts = resp.data;
                    app.isLoading = false;
                    console.log('posts', app.posts);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load posts");
                });
        },
        methods: {
            searchPost(searchTerm) {
                var app = this;

                if (app.currentSearchTerm !== searchTerm) {
                    app.currentSearchTerm = searchTerm;
                    app.isLoading = true;
                    axios.post('/api/v1/posts', {period: searchTerm})
                        .then(function (resp) {
                            app.posts = resp.data;
                            app.isLoading = false;
                        })
                        .catch(function (resp) {
                            console.log(resp);
                            alert("Could not load posts");
                        });
                }
            },
        }
    }
</script>
