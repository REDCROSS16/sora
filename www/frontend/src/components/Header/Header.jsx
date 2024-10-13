import styles from './Header.module.css';
import {SelectUser} from '../SelectUser/SelectUser.jsx';

function Header() {

	return (
		<>
			<img className={styles.logo} src="../../../public/logo.svg" alt="логотип"/>
			<SelectUser/>
		</>
	);
}

export default Header;