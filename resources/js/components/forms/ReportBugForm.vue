<template>
	<div class="float-element float-element--center-right" :class="{ 'float-element--active': toggle }" >
		<p class="button pink-button button--vertical" v-on:click="toggle = !toggle">REPORT A BUG</p>
		<transition name="jsFadeSlide">
			<div v-if="toggle">
				<div class="float-element__wrap">
					<label for="report">Describe your issue:</label>
					<textarea name="report" id="report" class="input__textarea input__textarea--report" cols="25" rows="10"></textarea>
					<button type="submit" class="button red-button button-smaller">SEND</button>
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