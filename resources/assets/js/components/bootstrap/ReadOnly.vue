<template>
<div class="form-group">
    <label>{{ bLabel }}</label>
    <div class="input-group" >
        <input type="text" readonly="true" class="form-control" :value="val" style="background-color:#ffffff;" v-if="uInput"/>
        <textarea readonly="true" class="form-control" style="background-color:#ffffff;" v-if="uTextarea">{{ bValue }}</textarea>
        
    </div>
</div>	
</template>
<script>
    export default {
    	props:[
    		'use-input',
    		'use-textarea',
    		'use-label',
    		'b-label',
    		'b-value'
    		],

    	data() {
    		return {
    			val: this.bValue,
    			uLabel: (this.useLabel == "true"),
                uInput: (this.useInput == "true"),
                uTextarea: (this.useTextarea == "true"),
    		}
    	},
        mounted() {

        }
    }
</script>