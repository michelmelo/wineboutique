<template>
	<div class="float-element--center-right ">
		<button class="button red-button button--rotate" v-on:click="toggle = !toggle"  :value="toggle">REPORT A BUG</button>
		<transition name="fade">
			<div class="float-element__wrap ">
				<div v-if="toggle">
					The sample text <br>
					Testing Vue Slide Transition
				</div>
		    </div>
	    </transition>
    </div>
</template>
<script>
    export default {
        data: () => ({
            toggle: false
        }),
        methods: {
        },
    }
</script>