import styles from './SelectUser.module.css';
import {useContext} from 'react';
import {UserContext} from '../../context/user.context.jsx';

export const SelectUser = () => {

	const {userId, setUserId} = useContext(UserContext);

	const changeUser = (e) => {
		setUserId(Number(e.target.value));
	};

	return (
		<select className={styles['select']} name="user" id="id" onChange={changeUser} value={userId}>
			<option value="1"> Anton</option>
			<option value="2"> Vasya</option>
		</select>
	);
};