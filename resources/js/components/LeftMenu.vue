<template>
    <ul class="main-menu">
        <li class="error" v-if="error">{{ error}}</li>
        <li v-for="menuItem in responseData">
            <router-link v-if="menuItem.nodes"
                         :to="menuItem.url"
                         :class="['collapsable',{ 'router-link-exact-active' : menuItem.url === activeUrlParams}]"
                         :data-target="'#' + menuItem.url.replace(/\//g, '')"
                         exact
            >
                <i v-if="menuItem.iconText" class="icon">{{ menuItem.iconText }}</i>
                <template v-else>
                    <i v-if="menuItem.icon" class="icon" :class="menuItem.icon"></i>
                </template>
                <transition name="fade">
                    <span v-show="sidebarOpen">{{ menuItem.text }}</span>
                </transition>
                <i class="toggler fas"></i>
            </router-link>
            <router-link v-else :to="menuItem.url" :class="{ 'router-link-exact-active' : menuItem.url === activeUrlParams}">
                <i v-if="menuItem.iconText" class="icon">{{ menuItem.iconText }}</i>
                <template v-else>
                    <i v-if="menuItem.icon" class="icon" :class="menuItem.icon"></i>
                </template>
                <transition name="fade">
                    <span v-show="sidebarOpen">{{ menuItem.text }}</span>
                </transition>
            </router-link>
            <left-menu-recursive v-if="menuItem.nodes" :menuParentItemUrl="menuItem.url" :menuItemNodes="menuItem.nodes" :sidebarOpen="sidebarOpen"></left-menu-recursive>
        </li>
    </ul>
</template>
<script>
    import axios from 'axios';
    import $ from 'jquery';
    import 'bootstrap';
    import LeftMenuRecursive from './LeftMenuRecursive';

    export default {
        components: { LeftMenuRecursive },
        data(){
            return {
                responseData: null,
                error: null,
                classes: ''
            };
        },
        created() {
            this.fetchData();
        },
        updated: function () {
            this.$nextTick(function () {
                $('.collapsable').on('click', function(){
                    let toggleId = $(this).data('target');
                    $(this).toggleClass('toggled')
                    $(toggleId).collapse('toggle')
                });
            });
        },
        computed: {
            sidebarOpen() {
                return this.$store.state.sidebar.sidebarOpen;
            },
            activeUrlParams: {
                get: function() {
                    return this.$store.state.options.activeUrlParams;
                },
                set: function(newValue) {
                    return newValue;
                }
            }
        },
        methods: {
            fetchData() {
                this.activeUrlParams = this.$store.state.options.activeUrlParams;
                this.error = this.responseData = null;
                this.classes = '';
                axios
                    .post('/bradmin/sidebar-menu')
                    .then(response => {
                        this.responseData = response.data;
                    })
                    .catch(error => {
                        this.error = error.response.data.message || error.message;
                    });
            }
        }
    }
</script>