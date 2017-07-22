<template>
	<div class = "form-group">
        <label v-if="uLabel">{{label}}</label>
        <div class="input-group" >
            <div class="input-group-addon" v-if="uIcon">
                <i class="ion" :class="icon" style="padding-right:3px; font-size:20px;"></i>
            </div>
            <input 
                id="" 
                :placeholder="bPlaceholder" 
                :type="ty" 
                class="form-control" 
                :name="nm" 
                :value="old" 
                autofocus>
            
        </div>
        <span class="help-block text-danger" v-if="err">
            <small>{{ bError }}</small>
        </span> 
	</div>
    

</template>

<script>
    export default {
    	props:['b-icon','b-placeholder','b-name','b-value','b-value','b-error','b-err','b-type', 'use-icon', 'use-label', 'label'],

    	data() {
    		return {
    			err: this.bError,
    			icon: this.bIcon,
    			ph: this.bPlaceholder,
    			ty: this.bType,
    			nm: this.bName,
    			old: this.bValue,
                uIcon: (this.useIcon == "true"),
                uLabel: (this.useLabel == "true"),
    		}
    	},
        mounted() {

        }
    }
</script>