<style>
    @import '~selectize/dist/css/selectize.bootstrap3.css';
</style>
<template>
    <div class="main-wrapper">
        <div class="fixed-sidebar-wrapper"
             v-bind:class="[sidebarClass,fixedSidebarclasses]"
             @mouseover="mouseOver"
             @mouseleave="mouseLeave"
        >
            <left-sidebar-header></left-sidebar-header>
            <left-menu></left-menu>
        </div>
        <div class="content-wrapper" v-bind:class="sidebarClass">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 panel-header">
                        <h1>{{ title }}</h1>
                    </div>
                </div>
                <div class="row panel-content-wrapper">
                    <div class="col-12 panel-content">
                        <transition name="router">
                            <router-view :key="$route.fullPath"></router-view>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LeftMenu from './LeftMenu';
    import LeftSidebarHeader from './LeftSidebarHeader';

    // function checkSideBarState(obj, over) {
    //     if(obj.sidebarOpenCookieStatus === 'false' || obj.sidebarOpenCookieStatus === false || obj.sidebarOpenCookieStatus === null || typeof obj.sidebarOpenCookieStatus === 'undefined'){
    //         if(over){
    //             obj.fixedSidebarclasses = 'open';
    //             obj.$store.commit('sidebarOpenState', true);
    //         }
    //         else{
    //             obj.fixedSidebarclasses = '';
    //             obj.$store.commit('sidebarOpenState', false)
    //         }
    //     }
    //     else{
    //     }
    // }

    export default {
        components: { LeftMenu, LeftSidebarHeader },
        data(){
            return {
                fixedSidebarclasses: '',
                sidebarOpenCookieStatus:this.$cookie.get('sidebarOpen'),
            };
        },
        computed: {
            title() {
                return this.$store.state.title.title;
            },
            sidebarClass() {
                return this.$store.state.sidebar.sidebarClass;
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
        created: function (){
            this.checkSidebarState();
        },
        methods: {
            mouseOver: function(){
                // console.log(this.$store.state.sidebar.sidebarOpen);
                // console.log(this.$store.state.sidebar.sidebarFixed);
                if(!this.$store.state.sidebar.sidebarOpen){
                    // this.fixedSidebarclasses = 'open';
                    this.$store.commit('sidebarOpenState', true);
                    this.$store.commit('sidebarClassChange', 'open');
                }
                console.log('over______');
                console.log('fixedClass: ' + this.fixedSidebarclasses);
                console.log('fixedState: ' + this.$store.state.sidebar.sidebarFixed);
                console.log('openState: ' + this.$store.state.sidebar.sidebarOpen);
            },
            mouseLeave: function(){
                if(!this.$store.state.sidebar.sidebarFixed && this.$store.state.sidebar.sidebarOpen){
                    // this.fixedSidebarclasses = '';
                    this.$store.commit('sidebarOpenState', false);
                    this.$store.commit('sidebarClassChange', '');
                }
                console.log('leave______');
                console.log('fixedClass: ' + this.fixedSidebarclasses);
                console.log('fixedState: ' + this.$store.state.sidebar.sidebarFixed);
                console.log('openState: ' + this.$store.state.sidebar.sidebarOpen);
            },
            checkSidebarState: function(){
                if(this.sidebarOpenCookieStatus === 'true'){
                    this.$store.commit('sidebarClassChange', 'open');
                    this.$store.commit('sidebarOpenState', true);
                    this.$store.commit('sidebarFixedState', true);
                }
            }
        }
    }
</script>
