import styles from './Input.module.css';
import {forwardRef} from 'react';

const Input = forwardRef( function Input({isValid, ...props}, ref) {
	return (
		<input {...props} ref={ref} className={`${styles['input']} ${isValid ? '' : styles.invalid}`} />
	);
});

export default Input;