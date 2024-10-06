import styles from './JournalForm.module.css';
import {useEffect, useState} from 'react';
import Button from '../Button/Button.jsx';

const INITIAL_STATE = {
	title: true,
	text: true,
	date: true,
	tag: true
};

function JournalForm({ onSubmit }) {

	// состояние валидации
	const [formValidState, setFormValidState] = useState(INITIAL_STATE);

	// через 2 секунды снимается подсветка с формы
	useEffect(() => {
		let timerId;
		if (!formValidState.date || !formValidState.text || !formValidState.title) {
			timerId = setTimeout(() => {
				setFormValidState(INITIAL_STATE);
			}, 2000);
		}

		return () => {
			clearTimeout(timerId);
		};
	}, [formValidState]);


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
		<form className={styles['journal-form']} onSubmit={addJournalItem}>
			<div>
				<input type="text" name="title"
				   className={`${styles['input-title']} ${formValidState.title ? '' : styles.invalid}`}/>
			</div>
			<div className={styles['form-row']}>
				<label htmlFor="date" className={styles['form-label']}>
					<img src="/calendar.svg" alt="иконка"/>
					<span>Дата</span>
				</label>
				<input type="date" name="date" id="date"
				   className={`${styles['input']} ${formValidState.date ? '' : styles.invalid}`}/>
			</div>

			<div className={styles['form-row']}>
				<label htmlFor="tag" className={styles['form-label']}>
					<img src="/tag.svg" alt="иконка"/>
					<span>Метки</span>
				</label>
				<input type="text" name="tag" id="tag"
					   className={`${styles['input']} ${formValidState.tag ? '' : styles.invalid}`}
				/>
			</div>


			<textarea name="text" id="" cols="30" rows="10"
					  className={`${styles['input']} ${formValidState.text ? '' : styles.invalid}`}>
			</textarea>
			<Button text="Save" />
		</form>
	);
}

export default JournalForm;