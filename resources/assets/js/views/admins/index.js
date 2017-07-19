const app = new Vue({
	el: '#root',
	data: {
		columns: [
        {
          label: 'Name',
          field: 'name',
          filterable: true,
        },
        {
          label: 'Age',
          field: 'age',
          type: 'number',
          html: false,
          filterable: true,
        },
        {
          label: 'Created On',
          field: 'createdAt',
          type: 'date',
          inputFormat: 'YYYYMMDD',
          outputFormat: 'MMM Do YY',
        },
        {
          label: 'Percent',
          field: 'score',
          type: 'percentage',
          html: false,
        },
      ],
      rows: [
        {id:1, name:"John",age:20,createdAt: '201-10-31:9:35 am',score: 0.03343},
        {id:2, name:"Jane",age:24,createdAt: '2011-10-31',score: 0.03343},
        {id:3, name:"Susan",age:16,createdAt: '2011-10-30',score: 0.03343},
        {id:4, name:"Chris",age:55,createdAt: '2011-10-11',score: 0.03343},
        {id:5, name:"Dan",age:40,createdAt: '2011-10-21',score: 0.03343},
        {id:6, name:"John",age:20,createdAt: '2011-10-31',score: 0.03343},
        {id:7, name:"Jane",age:24,createdAt: '20111031'},
        {id:8, name:"Susan",age:16,createdAt: '2013-10-31',score: 0.03343},
        {id:9, name:"Chris",age:55,createdAt: '2012-10-31',score: 0.03343},
        {id:10, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
        {id:11, name:"John",age:20,createdAt: '2011-10-31',score: 0.03343},
        {id:12, name:"Jane",age:24,createdAt: '2011-07-31',score: 0.03343},
        {id:13, name:"Susan",age:16,createdAt: '2017-02-28',score: 0.03343},
        {id:14, name:"Chris",age:55,createdAt: '',score: 0.03343},
        {id:15, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
        {id:16, name:"Chris",age:55,createdAt: '2011-10-31',score: 0.03343},
        {id:17, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
        {id:18, name:"John",age:20,createdAt: '201-10-31:9:35 am',score: 0.03343},
        {id:19, name:"Jane",age:24,createdAt: '2011-10-31',score: 0.03343},
        {id:20, name:"Susan",age:16,createdAt: '2011-10-30',score: 0.03343},
        {id:21, name:"Chris",age:55,createdAt: '2011-10-11',score: 0.03343},
        {id:22, name:"Dan",age:40,createdAt: '2011-10-21',score: 0.03343},
        {id:23, name:"John",age:20,createdAt: '2011-10-31',score: 0.03343},
        {id:24, name:"Jane",age:24,createdAt: '20111031'},
        {id:25, name:"Susan",age:16,createdAt: '2013-10-31',score: 0.03343},
        {id:26, name:"Chris",age:55,createdAt: '2012-10-31',score: 0.03343},
        {id:27, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
        {id:28, name:"John",age:20,createdAt: '2011-10-31',score: 0.03343},
        {id:29, name:"Jane",age:24,createdAt: '2011-07-31',score: 0.03343},
        {id:30, name:"Susan",age:16,createdAt: '2017-02-28',score: 0.03343},
        {id:31, name:"Chris",age:55,createdAt: '',score: 0.03343},
        {id:32, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
        {id:33, name:"Chris",age:55,createdAt: '2011-10-31',score: 0.03343},
        {id:34, name:"Dan",age:40,createdAt: '2011-10-31',score: 0.03343},
      ],
	},
	methods: {

		
	},
	computed: {

	},
	created() {

	},
	mounted() {

	}
});
