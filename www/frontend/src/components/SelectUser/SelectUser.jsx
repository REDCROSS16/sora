import './SelectUser.css';

export const SelectUser = ({changeUser}) => {

	return (
		<select name="user" id="id" onChange={changeUser}>
			<option value="1"> Anton</option>
			<option value="2"> Vasya</option>
		</select>
	);
};