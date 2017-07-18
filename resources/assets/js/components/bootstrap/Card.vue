<template>
    <div class="card">
	    <slot name="header">
	    	<div class="card-header">
		       	{{ title }}
		    </div>	
	    </slot>
	    
	    <div class="card-block">
	    	
	        <slot name="body"></slot>
	        <slot name="footer"></slot>
	    </div>
	</div>
</template>

<script>
    export default {
    	props:['title'],
        mounted() {
            console.log('Card mounted.')
        }
    }
</script>