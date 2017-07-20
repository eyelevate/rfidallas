<template>
	<div class = "form-group">
        <label v-if="uLabel">{{label}}</label>
        <div class="input-group">
        	<slot name="select"></slot>	
        </div>
        
        <span class="help-block text-danger" v-if="err">
            <small>{{ bError }}</small>
        </span> 
	</div>
    

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