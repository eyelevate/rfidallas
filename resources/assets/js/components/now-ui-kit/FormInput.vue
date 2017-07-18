<template>
	<div>
		<div class="input-group form-group-no-border">
	        <span class="input-group-addon" style="min-width:50px;">
	            <i class="ion" :class="icon" style="padding-right:3px; font-size:28px;"></i>
	        </span>
	        <input id="" :placeholder="bPlaceholder" :type="ty" class="form-control" :name="nm" :value="old" required autofocus>
	    </div>  
	    <div class="col-12" v-if="err">
	        <span class="help-block">
	            <strong>{{ bError }}</strong>
	        </span>
	    </div>	
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