<template>
	<div @click.prevent="toggleButton" :class="{ 'active' : isWishlistActive }">
		<a data-original-title="Save to Wishlist"
			class="btn btn-light"
			data-toggle="tooltip"
			@click="addWish">
			<i class="fa fa-heart" ></i>
		</a>
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
