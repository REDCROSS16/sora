import styles from './Header.module.css';
import {SelectUser} from '../SelectUser/SelectUser.jsx';

function Header() {

	const changeUser = () => {
		console.log(123);
	};

	return (
		<>
			<img className={styles.logo} src="../../../public/logo.svg" alt="логотип"/>

			<SelectUser changeUser={changeUser}/>
		</>
	);
}

export default Header;