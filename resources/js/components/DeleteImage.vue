<template>
	<div class=" container slider-items-owl owl-carousel owl-theme">
		<div class="row justify-content-center item-slide mt-2">
			<figure class=" card card-product pt-2" v-for="(image, index) in images">
				<div class="img-wrap">
					<img :src="'/storage/' + image.path" alt="image" style="width: 150px; max-height: 150px;">
				</div>
				<figcaption class="info-wrap text-center mt-2 mb-2">
					<button class="btn btn-danger btn-sm" @click="remove(image, image.product_id, index)">Delete</button>
				</figcaption>
			</figure>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['data'],

		data() {
			return {
				images: this.data
			};
		},

		methods: {
			remove(image, product_id, index) {
				axios.delete(`/admin/images/${product_id}/${image.id}/delete`)
					.then(this.images.splice(index, 1));
			}
		}
	};
</script>
