<template>
	<div>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Category</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(category, index) in categories">
					<td v-text="category.name"></td>
					<td>
						<button @click="handleClick(category, index)" class="btn btn-danger">Delete</button>
					</td>
				</tr>
				<tr v-if="this.categories.length == 0">
					<p>No categories yet.</p>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		props: ['data'],

		data() {
			return {
				categories: this.data
			};
		},

		methods: {
			handleClick(category, index) {
				this.$dialog
					.confirm(
				  		'Deletion of a category removes all products associated with it. Are you sure you want to delete it?')
					.then(dialog => {
					  	axios.delete(`/admin/categories/${category.id}/delete`)
							.then(this.categories.splice(index, 1));
				  	});
			}
		}
	};
</script>
