import styles from './JournalForm.module.css';
import {useContext, useEffect, useReducer, useRef} from 'react';
import Button from '../Button/Button.jsx';
import {ACTIONS, formReducer, INITIAL_STATE} from './JournalForm.state.js';
import Input from '../Input/Input.jsx';
import {UserContext} from '../../context/user.context.jsx';

function JournalForm({ onSubmit }) {

	const [formState, dispatchForm] = useReducer(formReducer, INITIAL_STATE);
	const { isValid, isFormReadyToSubmit, values} = formState;
	const {userId} = useContext(UserContext);
	const titleRef = useRef();
	const dateRef = useRef();
	const textRef = useRef();
	const tagRef = useRef();

	const focusError = (isValid) => {
		switch (true) {
		case !isValid.title:
			titleRef.current.focus();
			break;
		case !isValid.date:
			dateRef.current.focus();
			break;
		case !isValid.tag:
			tagRef.current.focus();
			break;
		case !isValid.text:
			textRef.current.focus();
			break;
		}
	};

	// через 2 секунды снимается подсветка с формы
	useEffect(() => {
		let timerId;
		if (!isValid.date || !isValid.text || !isValid.title) {
			focusError(isValid);
			timerId = setTimeout(() => {
				dispatchForm({type: ACTIONS.RESET_VALIDITY});
			}, 2000);
		}

		return () => {
			clearTimeout(timerId);
		};
	}, [isValid]);

	// проверка валидности
	useEffect(() => {
		if (isFormReadyToSubmit) {
			onSubmit(values);
			dispatchForm({type: ACTIONS.CLEAR});
		}
	}, [isFormReadyToSubmit, values, onSubmit]);

	useEffect(() => {
		dispatchForm({type: ACTIONS.SET_VALUE, payload: {userId}});
	}, [userId]);

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
			<div>{userId}</div>
			<div>
				<Input isValid={isValid.title} type="text" ref={titleRef} name="title" onChange={onchange}
					   value={values.title}
					   className={`${styles['input-title']} ${isValid.title ? '' : styles.invalid}`}/>
			</div>
			<div className={styles['form-row']}>
				<label htmlFor="date" className={styles['form-label']}>
					<img src="/calendar.svg" alt="иконка"/>
					<span>Дата</span>
				</label>
				<Input type="date" ref={dateRef} name="date" id="date" onChange={onchange} value={values.date}
					   className={`${styles['input']} ${isValid.date ? '' : styles.invalid}`}/>
			</div>

			<div className={styles['form-row']}>
				<label htmlFor="tag" className={styles['form-label']}>
					<img src="/tag.svg" alt="иконка"/>
					<span>Метки</span>
				</label>
				<Input type="text" ref={tagRef} name="tag" id="tag" onChange={onchange} value={values.tag}
					   className={`${styles['input']} ${isValid.tag ? '' : styles.invalid}`}/>
			</div>


			<textarea ref={textRef} name="text" id="" cols="30" rows="10" onChange={onchange}
					  value={values.text}
					  className={`${styles['input']} ${isValid.text ? '' : styles.invalid}`}>
			</textarea>
			<Button text="Save"/>
		</form>
	);
}

export default JournalForm;