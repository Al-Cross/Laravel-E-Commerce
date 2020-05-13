import Vue from 'vue';

const state = Vue.observable({
	isWishlistOpen: false
});

const mutator = {
	toggle() {
		state.isWishlistOpen = !state.isWishlistOpen;
	}
};

export {state};
export {mutator};
