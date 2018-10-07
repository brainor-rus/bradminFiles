// initial state
const state = {
    sidebarOpen: false,
    sidebarClass: ''
};

// mutations
const mutations = {
    sidebarOpenState (state, newState) {
        state.sidebarOpen = newState;
    },
    sidebarClassChange (state, newState) {
        state.sidebarClass = newState;
    },
};

export default {
    state,
    mutations
}