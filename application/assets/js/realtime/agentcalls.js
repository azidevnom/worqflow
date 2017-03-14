
Vue.component('indicators', {

	props: ['indicators'],

	render: function (E) {
		return E('div', Object.keys(this.indicators).map(ind => {
			return E('div', {
				'class': {
					card: true,
					cardBlock: true
				}
			}, this.indicators[ind].value );
		})
		);
	}

});

Vue.component('agent', {

	props: ['agent'],

	render: function (E) {
		return E('div', {
			'class': {
				card: true,
				cardBlock: true
			}
		})
	}

});

var agentcalls = new Vue({

	el: '#main',

	data: {
		indicators: [],
		table: {
			headers: [],
			agents: []
		}
	},

	methods: {
		retData: function () {
			axios.get('/api/v1/realtime').then(r => {
				this.indicators = r.data.data.indicators;
				this.table.headers = r.data.data.headers
				this.table.agents = r.data.data.agents;
			});
		}
	},

	mounted: function () {
		this.retData();
		setInterval(this.retData, 3000);
	}

});
