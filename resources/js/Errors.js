export class Errors {
	constructor() {
		this.errors = {};
	}

	get(field) {
		if (this.errors[field]) {
	        return this.errors[field][0];
	    }
    }

    record(errors) {
    	this.errors = errors;
    }

    any() {
    	return Object.keys(this.errors).length > 0;
    }

    clear(field) {
    	delete this.errors[field];
    }
}
