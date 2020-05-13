<template>
	<div @click.prevent="toggleButton" :class="{ 'active' : isWishlistActive }">
		<button type="submit" class="btn btn-success" @click="addWish">Add To Wishlist</button>
	</div>
</template>

<script>
import {state, mutator} from '../mutators.js';

export default {
	props: ['user', 'product'],

	computed: {
		isWishlistActive() {
			return state.isWishlistOpen;
		}
	},

	methods: {
		addWish() {
			axios.post(`/my-profile/${this.user}/wishlist`, {
				id: this.user,
				productId: this.product,
				withCredentials: true
			});
		},

		toggleButton() {
			mutator.toggle()
		}
	}
};
</script>
