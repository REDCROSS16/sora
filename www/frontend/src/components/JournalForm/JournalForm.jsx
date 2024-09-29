import './JournalForm.css';
import {useState} from 'react';
import Button from '../Button/Button.jsx';

function JournalForm({ onSubmit }) {

	// состояние валидации
	const [formValidState, setFormValidState] = useState({
		title: true,
		text: true,
		date: true,
		tag: true
	});


	const addJournalItem = (e) => {
		e.preventDefault();
		const formData = new FormData(e.target);
		const formProps = Object.fromEntries(formData);
		let isFormValid = true;

		if (!formProps.title.trim().length) {
			setFormValidState(state => ({ ...state, title: false }));
			isFormValid = false;
		} else {
			setFormValidState(state => ({ ...state, title: true }));
		}

		if (!formProps.text.trim().length) {
			setFormValidState(state => ({ ...state, text: false  }));
			isFormValid = false;
		} else {
			setFormValidState(state => ({ ...state, text: true }));
		}

		if (!formProps.tag.trim().length) {
			setFormValidState(state => ({ ...state, tag: false }));
			isFormValid = false;
		} else {
			setFormValidState(state => ({ ...state, tag: true }));
		}

		if (!formProps.date) {
			setFormValidState(state => ({ ...state, date: false }));
			isFormValid = false;
		} else {
			setFormValidState(state => ({ ...state, date: true }));
		}

		return (!isFormValid) ? undefined : onSubmit(formProps);
	};

	return (
		<form className="journal-form" onSubmit={addJournalItem}>
			<input type="text" name="title" style={{border:formValidState.title ? undefined : '1px solid red'}}/>
			<input type="date" name="date" style={{border:formValidState.date ? undefined : '1px solid red'}}/>
			<input type="text" name="tag" style={{border:formValidState.tag ? undefined : '1px solid red'}}/>
			<textarea name="text" id="" cols="30" rows="10" style={{border:formValidState.text ? undefined : '1px solid red'}}>
			</textarea>
			<Button text="Save" />
		</form>
	);
}

export default JournalForm;