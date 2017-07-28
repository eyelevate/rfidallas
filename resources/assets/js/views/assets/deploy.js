const app = new Vue({
	el: '#root',

	data() {
		return {
			users: [],
			user: [],
			companies: [],
			company: [],
			companyCount: 0,
			company_id: '',
			company_name: '',
			serial: '',
			serials: [],
			assets: []
		}
		
	},
	methods: {

		displayCompanies(user_id) {
			// get fee info from server and post it to form
			companies = this.companies;
			company = [];
			if (this.users.length > 0) {
				this.users.forEach( function(v, k) {
					if (parseInt(v.id) == parseInt(user_id)) {
						this.user = v;
						if (companies.length > 0) {
							companies.forEach( function(cv, ck) {
								if (parseInt(cv.user_id) == parseInt(user_id)) {
									company[ck] = cv;

								}
							});
						}
						
					}
				});
			}
			this.companyCount = company.length;
			this.company = $.makeArray(company);

		},
		setCompany(obj)
		{
			this.company.push(obj);
		},
		setVariables(users, companies) {
			this.company = [];
			this.users = users;
			this.companies = companies;
		},
		selectCompanyFromUser(company_id)
		{

			this.company_id = company_id;
			companies = this.companies;
			company_name = '';
			//get company info
			if (companies.length > 0) {
				companies.forEach( function(v, k) {
					if (parseInt(v.id) == parseInt(company_id)) {
						company_name = v.name+' ('+v.nick_name+')';	
					}
				});
			}

			$("#usersSelect").addClass('active');
			$("#companiesSelect").removeClass('active');
			$("#nav-select-users").addClass('active');
			$("#nav-select-company").removeClass('active');
			$("#userModal").modal('hide');
			this.company = [];
			this.user = [];
			this.company_name = company_name;
		},
		selectCompany(company_id)
		{
			this.company_id = company_id;
			companies = this.companies;
			company_name = '';
			//get company info
			if (companies.length > 0) {
				companies.forEach( function(v, k) {
					if (parseInt(v.id) == parseInt(company_id)) {
						company_name = v.name+' ('+v.nick_name+')';	
					}
				});
			}
			$("#companyModal").modal('hide');
			this.company = [];
			this.company_name = company_name;	
		},
		serialSubmit()
		{
			serial = this.serial;
			serials = this.serials;
			if (!serials.includes(serial)) {
				
				if (this.company_id == '') {
					alert('You must select a company before submitting an asset for deployment! Please try again.')
				} else {
					// get fee info from server and post it to form
					axios.post('/asset-items/update/deploy',{serial:this.serial,company_id:this.company_id}).then(response => {
						let status = response.data.status;
						if (status == 'fail') {
							alert('No such serial number exists in our system. Please try again or create the asset.');
						} else {
							this.assets.push(response.data.data);
							this.serials.push(this.serial);
							this.serial = '';
						}
					});
				}
			} else {
				alert('You have already deployed this asset in this session. Please try again.');
			}
			
			
			
		},
		undoAsset(asset_id)
		{
			// get fee info from server and post it to form
			axios.post('/asset-items/undo/deploy',{asset_id:asset_id}).then(response => {
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

$(document).ready(function(){
	deploy.variables();
	deploy.events();
	
});

deploy = {
	events: function() {
		$(document).on('click','.select-customer',function() {
			let user_id = $(this).attr('customer-id');
			app.displayCompanies(user_id);
			$("#usersSelect").removeClass('active');
			$("#companiesSelect").addClass('active');
			$("#nav-select-users").removeClass('active');
			$("#nav-select-company").addClass('active');
		});

		$(document).on('click','.select-company',function() {
			let company_id = $(this).attr('company-id');
			console.log(company_id);
			app.selectCompany(company_id);
		});
	},
	variables: function() {
		let usersData = JSON.parse($('#get-users-data').val());
		let companyData = JSON.parse($('#get-companies-data').val());
		app.setVariables(usersData, companyData);
	},
}