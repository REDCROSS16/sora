import styles from './JournalForm.module.css';
import {useEffect, useReducer, useState} from 'react';
import Button from '../Button/Button.jsx';
import {ACTIONS, formReducer, INITIAL_STATE} from './JournalForm.state.js';

function JournalForm({ onSubmit }) {

	const [formState, dispatchForm] = useReducer(formReducer, INITIAL_STATE);
	const { isValid, isFormReadyToSubmit, values} = formState;

	// через 2 секунды снимается подсветка с формы
	useEffect(() => {
		let timerId;
		if (!isValid.date || !isValid.text || !isValid.title) {
			timerId = setTimeout(() => {
				dispatchForm({type: ACTIONS.RESET_VALIDITY});
			}, 2000);
		}

		return () => {
			clearTimeout(timerId);
		};
	}, [isValid]);

	useEffect(() => {
		if (isFormReadyToSubmit) {
			onSubmit(values);
			dispatchForm({type: ACTIONS.CLEAR});
		}
	}, [isFormReadyToSubmit]);

	const onchange = (e) => {
		dispatchForm({
			type: ACTIONS.SET_VALUE,
			payload: {[e.target.name]: e.target.value}
		});
	};


	const addJournalItem = (e) => {
		e.preventDefault();
		dispatchForm({type: ACTIONS.SUBMIT});
	};

	return (
		<form className={styles['journal-form']} onSubmit={addJournalItem}>
			<div>
				<input type="text" name="title" onChange={onchange} value={values.title}
				   className={`${styles['input-title']} ${isValid.title ? '' : styles.invalid}`}/>
			</div>
			<div className={styles['form-row']}>
				<label htmlFor="date" className={styles['form-label']}>
					<img src="/calendar.svg" alt="иконка"/>
					<span>Дата</span>
				</label>
				<input type="date" name="date" id="date" onChange={onchange} value={values.date}
				   className={`${styles['input']} ${isValid.date ? '' : styles.invalid}`}/>
			</div>

			<div className={styles['form-row']}>
				<label htmlFor="tag" className={styles['form-label']}>
					<img src="/tag.svg" alt="иконка"/>
					<span>Метки</span>
				</label>
				<input type="text" name="tag" id="tag" onChange={onchange} value={values.tag}
					   className={`${styles['input']} ${isValid.tag ? '' : styles.invalid}`}
				/>
			</div>


			<textarea name="text" id="" cols="30" rows="10" onChange={onchange} value={values.text}
					  className={`${styles['input']} ${isValid.text ? '' : styles.invalid}`}>
			</textarea>
			<Button text="Save" />
		</form>
	);
}

export default JournalForm;