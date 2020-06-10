<template>
	<span class="invalid-feedback d-block" role="alert">
		<slot></slot>
	</span>
</template>

<script>
	export default {
		props: ['errors']
	};
</script>
