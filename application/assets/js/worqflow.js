window.worqflow = {
	settings: {
		get(section, type, name) {
			return new Promise((resolve, reject) => {
				return axios.get('/api/v1/settings', {params:{section, type, name}}).then(r => {
					if (r.data.result === 'success') { resolve(JSON.parse(r.data.data)) } else { throw 'Unable to get setting'}
				}).catch(e => reject(e))
			})
		},
		set(section, type, name, data) {
			return new Promise((resolve, reject) => {
				return axios.post('/api/v1/settings', {section, type, name, data}).then(r => resolve(r)).catch(e => reject(e))
			})
		}
	}
};