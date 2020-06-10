<template>
	<div class="sidebar">
		<div class="sidebar-backdrop" @click="closeWishlist" v-if="isWishlistOpen"></div>
		<transition name="slide" v-if="isWishlistOpen">
			<div class="sidebar-panel">
				<h4 class="text-white"><u>The Wishlist</u></h4>
				<figure class="card card-product mb-4" v-for="(item, index) in items" :key="item.id">
                    <div class="img-wrap padding-y" v-for="image in item.product.images.slice(0, 1)">
                    <img :src="'/storage/' + image.path"
                        style="height: 200px;"
                        alt="mainImage"
                    >
                    </div>
                    <figcaption class="info-wrap">
                        <h4 class="title" v-text="item.product.name"></h4>
                    </figcaption>
                    <div class="bottom-wrap">
                        <div class="price h3 text-danger">
                            <span v-text="item.product.price"></span>
                        </div>
                    </div>
                </figure>
			</div>
		</transition>
	</div>
</template>

<script>
import {state, mutator} from '../mutators.js';

export default {
	props: ['user'],

	data() {
		return {
			items: []
		};
	},

	watch: {
		isWishlistOpen() {
			this.getProducts();
		}
	},

	computed: {
		isWishlistOpen() {
			return state.isWishlistOpen;
		}
	},

	methods: {
		getProducts() {
			axios.get(`/my-profile/${this.user}/wishlist`)
				.then(response => {
					this.items = response.data;
				});
		},

		closeWishlist() {
			mutator.toggle();
		}
	}
};
</script>

<style>
	.slide-enter-active,
    .slide-leave-active
    {
        transition: transform 0.2s ease;
    }
    .slide-enter,
    .slide-leave-to {
        transform: translateX(-100%);
        transition: all 150ms ease-in 0s
    }
	.sidebar-backdrop {
        background-color: rgba(0,0,0,.5);
        width: 100vw;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        cursor: pointer;
    }
    .sidebar-panel {
        overflow-y: auto;
        background-color: #130f40;
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 999;
        padding: 3rem 20px 2rem 20px;
        width: 450px;
    }
</style>
