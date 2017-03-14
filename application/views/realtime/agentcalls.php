<section id="agentcalls" class="container-fluid top-margin">
	<section class="row container-fluid">
		<indicators :indicators="indicators"></indicators>
	</section>
	<section class="row container-fluid top-margin">
		<agents :agents="agents"></agents>
	</section>
</section>

<!-- INDICATOR SETUP -->
<script type="text/x-template" id="indicator-setup">
	
	</div>
</script>

<!-- INDICATOR -->
<script type="text/x-template" id="indicator">
	<div :class="{'card-block': true, 'indicator': true, 'indicator-alarmed': alarm.alarmed}">
		<div class="indicator-cover" 
			@dblclick="invokeConfig(indicator.status, indicator.label, icon)" 
			@mouseover="mouseOver"
			@mouseout="mouseOut">
		</div>
		<h1 class="d-inline-block">{{indicator.value}}</h1>
			<i :class="{'material-icons': true, 'icon': true, 'animated': alarm.alarmed, 'infinite': alarm.alarmed,'flash': alarm.alarmed}">{{icon}}</i><br>
		<small :class="{'text-muted': true, 'd-block': true, 'text-center': true, 'underlined': alarm.enabled }">{{indicator.label}}</small>
	</div>
</script>

<!-- INDICATORS -->
<script type="text/x-template" id="indicators">
	<div>
		<div class="indicators">
			<div class="row">
				<div class="col">
					<indicator class="d-inline-block" 
					v-for="indicator in indicators" 
					:indicator="indicator" 
					:key="indicator.status.toLowerCase()" 
					:alarm="alarmState(indicator.status.toLowerCase())">
					</indicator>
				</div>
			</div>
		</div>
		<transition name="modal">
				<div v-if="showConfig" class="modal-mask">
					<div class="modal-wrapper">
						<div class="modal-container" style="width: 300px">
							<div class="modal-header justify-content-start">
								<label class="switch">
									<input type="checkbox" v-model="currentConfig.enabled">
									<div class="slider round"></div>
								</label>
								{{currentName}}
								<button class="modal-close" @click="closeConfig">
									<i class="material-icons icon">close</i>
								</button>
							</div>

							<div class="modal-body">
								<form>
									<div class="form-group row">
										<div class="col-3 text-center" style="font-size:20pt; margin-top:-1px;">≥</div>
										<div class="col-6">
											<input class="form-control" multiple type="range" min="0" :max="currentConfig.lessThan" id="example-text-input" v-model="currentConfig.moreThan" style="margin-top:5px;">
										</div>
										<div class="col-3 text-center" style="font-size:20pt;">{{currentConfig.moreThan}}</div>
									</div>
									<div class="form-group row">
										<div class="col-3 text-center" style="font-size:20pt; margin-top:-1px;">≤</div>
										<div class="col-6">
											<input class="form-control" type="range" :min="currentConfig.moreThan" max="250" id="example-text-input" v-model="currentConfig.lessThan" style="margin-top:5px;">
										</div>
										<div class="col-3 text-center" style="font-size:20pt;">{{currentConfig.lessThan}}</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
		</transition>
	</div>
</script>

<!-- AGENT -->
<script type="text/x-template" id="agent">
	<div v-show="state.shown" :class="agentClasses" @dblclick="invokeUser">
		<span :class="agentIconClasses"><i class="material-icons">{{icon}}</i></span>
		<span class="agent-divider"></span>
		<div class="agent-user">{{agent.full_name}}</div>
		<div class="text-right agent-elapsed">{{agent.elapsed_time}}</div>
	</div>
</script>

<!-- AGENTS -->
<script type="text/x-template" id="agents">
	<div>
		<div class="col">
			<div class="d-inline-block" v-for="agent in agents.rows">
				<agent :agent="agent"></agent>
			</div>
		</div>
		<transition name="modal">
			<div v-if="showAgent" class="modal-mask">
				<div class="modal-wrapper">
					<div class="modal-container" style="width:500px">
						<div class="modal-header justify-content-start">
							{{currentAgent.full_name}}
							<button class="modal-close" @click="closeAgent">
								<i class="material-icons icon">close</i>
							</button>
						</div>

						<div class="modal-body">
							<form>
								<div class="form-group row">
									
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</transition>
	</div>
</script>

<script>

// Event bus
const $bus = new Vue();

// Indicator item
Vue.component('indicator', {
	template: '#indicator',
	props: ['indicator', 'alarm'],
	data() {
		return {
			hovered: false
		}
	},
	methods: {
		mouseOver() { 
			if (!this.hovered) {
				this.hovered = true;
				setTimeout(() => {
					if (this.hovered) {	$bus.$emit('m-over', this.indicator.status); }
				},200)
			}
		},
		mouseOut() { 
			if (this.hovered) {
				this.hovered = false;
				setTimeout(() => {
					if (!this.hovered) { $bus.$emit('m-out'); }
				}, 200)
			}
		},
		invokeConfig(id, name, icon) { $bus.$emit('ind-setup', {'id':id.toLowerCase(), 'name': name, 'icon': icon }); }
	},
	computed: {
		icon() {
			switch (this.indicator.status) {
				case 'CONNECTED': return 'people_outlined'; break;
				case 'INCALL': return 'phone_in_talk'; break;
				case 'INBOUND': return 'call_received'; break;
				case 'MANUAL': return 'arrow_upward'; break;
				case 'AUTO': return 'call_made'; break;
				case 'PAUSED': return 'pause'; break;
				case 'READY': return 'done'; break;
				case 'DISPO': return 'more_horiz'; break;
				case 'DEAD': return 'remove_circle_outline'; break;
			}
		}
	}
});

// Indicators wrapper
Vue.component('indicators', {
	template: '#indicators',
	props: ['indicators'],
	data() {
		return {
			alarms: {
				enabled: true,
				config: {
					connected: { enabled: false, lessThan: 100, moreThan: 0, status: 'connected' },
					incall: { enabled: false, lessThan: 100, moreThan: 0, status: 'incall' },
					inbound: { enabled: false, lessThan: 100, moreThan: 0, status: 'inbound' },
					auto: { enabled: false, lessThan: 100, moreThan: 0, status: 'auto' },
					manual: { enabled: false, lessThan: 100, moreThan: 0, status: 'manual' },
					paused: { enabled: false, lessThan: 100, moreThan: 0, status: 'paused' },
					ready: { enabled: false, lessThan: 100, moreThan: 0, status: 'ready' },
					dispo: { enabled: false, lessThan: 100, moreThan: 0, status: 'dispo' },
					dead: { enabled: false, lessThan: 100, moreThan: 0, status: 'dead' }
				}
			},
			alarmStates: {
				connected: { alarmed: false },
				incall: { alarmed: false },
				inbound: { alarmed: false },
				auto: { alarmed: false },
				manual: { alarmed: false },
				paused: { alarmed: false },
				ready: { alarmed: false },
				dispo: { alarmed: false },
				dead: { alarmed: false }
			},
			currentConfig: null,
			currentName: null,
			currentIcon: null,
			showConfig: false
		}
	},
	methods: {
		closeConfig() {
			this.saveConfig();
			this.showConfig = false;
			this.currentConfig = null;
		},
		retrieveConfig() { worqflow.settings.get("reports","realtime","alarms").then(r => this.alarms = r) },
		saveConfig() { 
			worqflow.settings.set("reports","realtime","alarms", this.alarms); 
			//$.notify({title:"test",message:"caca"},{showProgressbar:true});
		},
		alarm() {
			const alarmSound = new Audio('/assets/audio/alert1.mp3');
			setInterval(() => {
				this.indicators.forEach(ind => {
					let i = this.alarms.config[ind.status.toLowerCase()];
					if (i.enabled && this.alarms.enabled) {
						if ((i.lessThan >= ind.value) && (i.moreThan <= ind.value)) {
							this.alarmStates[ind.status.toLowerCase()].alarmed = true;
							alarmSound.play();
						} else {
							this.alarmStates[ind.status.toLowerCase()].alarmed = false;
						}
					} else {
						this.alarmStates[ind.status.toLowerCase()].alarmed = false;
					}
				});
			}, 1000);
		},
		alarmState(status) {
			return {
				enabled: this.alarms.config[status].enabled,
				alarmed: this.alarmStates[status].alarmed
			}
		}
	},
	mounted() {
		this.retrieveConfig();
		$bus.$on('ind-setup', (data) => {
			this.currentName = data.name;
			this.currentIcon = data.icon;
			this.currentConfig = this.alarms.config[data.id];
			this.showConfig = true;
		});
		this.alarm();
	}
});

// Agent item
Vue.component('agent', {
	template: '#agent',
	props: ['agent'],
	data() {
		return {
			state: {
				shown: true,
				dimmed: false,
				blinking: false
			},
		}
	},
	computed: {
		agentIconClasses() { 
			return {
				'agent-icon': true,
				'agent-ready': (this.status == 'READY') ? true : false,
				'agent-paused': (this.status == 'PAUSED') ? true : false,
				'agent-talking': (this.status == 'INCALL' || this.status == 'MANUAL' || this.status == 'INBOUND' || this.status == 'AUTO') ? true : false,
				'agent-dispo': (this.status == 'DISPO') ? true : false,
				'agent-dead': (this.status == 'DEAD') ? true : false
			}
		},
		agentClasses() {
			return {
				'agent': true,
				'agent-dimmed': this.state.dimmed
			}
		},
		status() { 
			if (this.agent.status == "CLOSER") {
				return "READY";
			} else if (this.agent.status == "INCALL") {
				if (this.agent.comments == "MANUAL") {
					return "MANUAL";
				} else if (this.agent.comments == "INBOUND") {
					return "INBOUND";
				} else if (this.agent.comments == "AUTO") {
					return "AUTO";
				} else {
					return "INCALL";
				}
			} else {
				return this.agent.status;
			}
		},
		icon() {
			switch (this.status) {
				case 'INBOUND': return 'call_received'; break;
				case 'MANUAL': return 'arrow_upward'; break;
				case 'AUTO': return 'call_made'; break;
				case 'PAUSED': return 'pause'; break;
				case 'READY': return 'done'; break;
				case 'DISPO': return 'more_horiz'; break;
				case 'DEAD': return 'remove_circle_outline'; break;
				case 'QUEUE': return 'hourglass_empty'; break;
			}
		}
	},
	methods: {
		invokeUser() {
			$bus.$emit('show-user', this.agent);
		}
	},
	mounted() {
		$bus.$on('m-over', status => {
			if (this.status !== status) {
				if (!(status == 'INCALL' && (this.status == 'MANUAL' || this.status == 'INBOUND' || this.status == 'AUTO')) && status !== 'CONNECTED') {
					this.state.dimmed = true;
				}
			}
		});
		$bus.$on('m-out', () => this.state.dimmed = false);
	}
});

// Agents wrapper
Vue.component('agents', {
	template: '#agents',
	props: ['agents'],
	data() {
		return {
			currentAgent: null,
			showAgent: false
		}
	},
	methods: {
		closeAgent() {
			this.currentAgent = null;
			this.showAgent = false;
		}
	},
	mounted() {
		$bus.$on('show-user', (agent) => {
			this.currentAgent = agent;
			this.showAgent = true;
		});
	}
});

// MAIN VUE
const APP = new Vue({
	el: '#agentcalls',
	data: {
		indicators: [],
		agents: {
			headers: [],
			rows: []
		}
	},
	methods: {
		retData() {
			axios.get('/api/v1/realtime').then(r => {
				this.indicators = r.data.data.indicators;
				this.agents.headers = r.data.data.headers;
				this.agents.rows = r.data.data.agents;
			});
		}
	},
	mounted() {
		this.retData();
		setInterval(this.retData, 6000);
	}
});

</script>