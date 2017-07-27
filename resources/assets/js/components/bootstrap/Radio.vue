<template>
	<fieldset>
		<label v-if="uLabel">{{ label }}</label>
		<div class="form-check">
			<slot name="radio"></slot>
		</div>
		<span class="help-block text-danger" v-if="err">
            <small>{{ bError }}</small>
        </span> 
	</fieldset>
</template>

<script>
    export default {
    	props:['b-error','b-err', 'use-label', 'label'],

    	data() {
    		return {
    			err: this.bError,
                uLabel: (this.useLabel == "true")
    		}
    	},
        mounted() {

        }
    }
</script>