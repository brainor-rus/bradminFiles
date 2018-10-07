<template>
    <button @click="changeSidebarOpenCookie(sidebarOpenButtonAction)">Развернуть</button>
</template>
<script>

    export default {
        data(){
            return {
                sidebarOpenButtonAction:this.$cookie.get('sidebarOpen'),
            };
        },
        methods: {
            changeSidebarOpenCookie(actionValue) {
                let value;

                if(actionValue === 'false' || actionValue === false || actionValue === null || typeof actionValue === 'undefined'){
                    value = true;
                    this.$store.commit('sidebarClassChange', 'open')
                    this.$store.commit('sidebarOpenState', value);
                }else{
                    value = false;
                    this.$store.commit('sidebarClassChange', '');
                }
                this.sidebarOpenButtonAction = value;


                this.$cookie.set('sidebarOpen', this.sidebarOpenButtonAction, { expires: '1Y' });
            }
        }
    }
</script>