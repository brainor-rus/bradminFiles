<style>
    @import '../../css/sidebarHeader.css';
</style>

<template>
    <div class="align-items-center d-flex justify-content-between sidebar-header">
        <router-link to="/bradmin"><img class=" logo-img" :src="getLogoUrl" alt=""></router-link>
        <button class="sidebar-toggle-btn" @click="changeSidebarOpenCookie(sidebarOpenButtonAction)"><i :class="ico"></i></button>
    </div>
</template>

<script>

    export default {
        data(){
            return {
                sidebarOpenButtonAction:this.$cookie.get('sidebarOpen'),
                ico: ""
            };
        },
        created: function () {
            let val = this.$cookie.get('sidebarOpen');
            if(val === 'false' || val === false || val === null || typeof val === 'undefined'){
                this.$data.ico = "fa fa-list-ul"
            }else{
                this.$data.ico = "fa fa-bars"
            }
        },
        methods: {
            changeSidebarOpenCookie(actionValue) {
                let value;
                var vm = this;
                if(actionValue === 'false' || actionValue === false || actionValue === null || typeof actionValue === 'undefined'){
                    value = true;
                    this.$store.commit('sidebarClassChange', 'open');
                    this.$store.commit('sidebarOpenState', value);
                    vm.$data.ico = "fa fa-bars"

                }else{
                    value = false;
                    this.$store.commit('sidebarClassChange', '');
                    vm.$data.ico = "fa fa-list-ul"
                }
                this.sidebarOpenButtonAction = value;


                this.$cookie.set('sidebarOpen', this.sidebarOpenButtonAction, { expires: '1Y' });
            }
        },
        computed: {
            getLogoUrl: function () {
                return this.$store.state.sidebar.logoUrl;
            }
        }
    }
</script>