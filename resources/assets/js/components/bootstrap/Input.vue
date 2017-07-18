<template>
	<div>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon" style="width:40px;">
                <i class="ion" :class="icon" style="padding-right:3px; font-size:20px;"></i>
            </div>
            <input id="" :placeholder="bPlaceholder" :type="ty" class="form-control" :name="nm" :value="old" required autofocus>
            
        </div>
        <span class="help-block" v-if="err">
            <small>{{ bError }}</small>
        </span> 
	</div>
    

</template>

<script>
    export default {
    	props:['b-icon','b-placeholder','b-name','b-value','b-value','b-error','b-err','b-type'],
    	data() {
    		return {
    			err: this.bError,
    			icon: this.bIcon,
    			ph: this.bPlaceholder,
    			ty: this.bType,
    			nm: this.bName,
    			old: this.bValue
    		}
    	},
        mounted() {

        }
    }
</script>