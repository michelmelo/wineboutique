<template>
	<div class="float-element float-element--center-right" :class="{ 'float-element--active': toggle }" >
		<p class="button pink-button button--vertical" v-on:click="toggle = !toggle">REPORT A BUG</p>
		<transition name="jsFadeSlide">
			<div v-if="toggle">
				<div class="float-element__wrap">
					<label for="report">Describe your issue:</label>
					<textarea name="report" id="report" class="input__textarea input__textarea--report" cols="25" rows="10" v-model="reportText" :disabled="disabledForm"></textarea>
					<button type="button" class="button red-button button-smaller" @click="sendReport" :disabled="disabledForm">SEND</button>
				</div>
		    </div>
	    </transition>
    </div>
</template>
<script>
    export default {
        data: () => ({
            toggle: false,
			reportText: '',
			disabledForm: false,
        }),
        methods: {
            sendReport() {
                let dis = this
				if(dis.reportText!=='') {
                    dis.disabledForm = true
                    axios.post('/bug-report', {text: dis.reportText,}).then(response => {
                        // console.log(response)
                        dis.toggle = !dis.toggle
                        dis.reportText = ''
                        dis.disabledForm = false
                    })
                }
			}
        },
    }
</script>