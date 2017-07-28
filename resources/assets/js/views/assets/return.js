const app = new Vue({
	el: '#root',

	data() {
		return {
			serial: '',
			serials: [],
			assets: []
		}
		
	},
	methods: {

		serialSubmit()
		{
			serial = this.serial;
			serials = this.serials;
			if (!serials.includes(serial)) {
				
				// get fee info from server and post it to form
				axios.post('/asset-items/update/return',{serial:this.serial}).then(response => {
					let status = response.data.status;
					if (status == 'fail') {
						alert('No such serial number exists in our system. Please try again or create the asset.');
					} else {
						this.assets.push(response.data.data);
						this.serials.push(this.serial);
						this.serial = '';
					}
				});
			} else {
				alert('You have already returned this asset in this session. Please move on to the next asset.');
			}
			
			
			
		},
		undoAsset(asset_id)
		{
			console.log('youu clicked here');
			// get company id of last issued item
			assets = this.assets;
			last_company_id = '';
			if (assets.length > 0) {
				assets.forEach( function(v, k) {
					if (String(v.id) == String(asset_id)) {
						last_company_id = v.company_id;
					}
				});
			}

			// get fee info from server and post it to form
			axios.post('/asset-items/undo/return',{asset_id:asset_id,company_id:last_company_id}).then(response => {
				let status = response.data.status;
				if (status == 'fail') {
					alert(response.data.reason);
				} else {
					// remove assets
					assets = this.assets;
					if (assets.length > 0) {
						assets.forEach( function(v, k) {
							if (String(v.id) == String(asset_id)){
								assets.splice(k,1);
							}
						});
					}
					this.assets = assets;
					var serial_index = this.serials.indexOf(response.data.data.serial);
					if (serial_index > -1) {
						this.serials.splice(serial_index,1);
					}
					// remove serials
					this.serial = '';

					// remove parent tr
					this.$parent.tr.$remove();

				}
			});
		}

	},
	computed: {
	},
	created() {
	},
	mounted() {

	}
});
