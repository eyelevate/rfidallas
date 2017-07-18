<template>
    <div class="card">
	    <div class="card-header" v-if="checkCardHeader">
	       	<slot name="header"></slot>
	    </div>
	    <div class="card-block" :class="bClass" v-if="checkCardBody">
	        <slot name="body"></slot>
	    </div>
	    <div class="card-footer" :class="fClass" v-if="checkCardFooter">
	    	<slot name="footer"></slot>
	    </div>
	</div>
</template>

<script>
    export default {
    	props:['body-class','footer-class','use-header','use-body','use-footer'],
    	data() {
    		return {
    			checkCardHeader: (this.useHeader == 'true'),
    			checkCardBody: (this.useBody == 'true'),
    			checkCardFooter: (this.useFooter == 'true'),
    			bClass: this.bodyClass,
    			fClass: this.footerClass
    		}
    	},
    	methods: {

    	},
        mounted() {

        }
    }
</script>