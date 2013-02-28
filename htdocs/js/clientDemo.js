window.DemoClient = function(demoProxy) {
	this.getTime = function() {
		demoProxy.operations.getTime().execute(function(operation){
			console.log('server time(stamp):', operation.data.result);
		});
	};
	this.addNumbers = function(a, b) {
		demoProxy.operations.add(a, b).execute(function(operation) {
			console.log('sum: ', operation.data.result);
		}).error(function(operation){
			console.log('exception:', operation.data.exception);
		});
	};
	this.validateAddress = function(address) {
		demoProxy.operations.validateAddress(address).execute(function(operation) {
			console.log('validate address returned', operation.data.result);
			for(var i in operation.data.messages) {
				var fieldValidation = operation.data.messages[i];
				console.log('field validation', fieldValidation);
			}
		});
	};
}
var client = new window.DemoClient(window.DemoProxy);

