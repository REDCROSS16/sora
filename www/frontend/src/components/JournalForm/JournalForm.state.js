export const INITIAL_STATE = {
	isValid: {
		title: true,
		text: true,
		date: true,
		tag: true
	},
	values: {
		title: '',
		text: '',
		date: '',
		tag: ''
	},
	isFormReadyToSubmit: false
};

export const ACTIONS = Object.freeze({
	RESET_VALIDITY:   Symbol('RESET_VALIDITY'),
	CLEAR: Symbol('CLEAR'),
	SUBMIT:  Symbol('SUBMIT'),
	SET_VALUE: Symbol('SET_VALUE')
});

export function formReducer(state, action) {
	switch (action.type) {
	case ACTIONS.SET_VALUE:
		return {...state, values: {...state.values, ...action.payload }};
	case ACTIONS.CLEAR:
		return {...state, values: INITIAL_STATE.values};
	case ACTIONS.RESET_VALIDITY:
		return {...state, isValid: INITIAL_STATE.isValid};
	case ACTIONS.SUBMIT: {
		const titleValidity = state.values.title?.trim().length;
		const dateValidity = state.values.date;
		const tagValidity = state.values.tag?.trim().length;
		const textValidity = state.values.text?.trim().length;

		return {
			...state,
			isValid: {
				title: titleValidity,
				date: dateValidity,
				tag: tagValidity,
				text: textValidity
			},
			isFormReadyToSubmit: titleValidity && dateValidity && tagValidity && textValidity
		};
	}
	default:
		return;
	}
}