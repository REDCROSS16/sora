import styles from './Input.module.css';
import React from 'react';
import cn from 'classnames';
import {InputProps} from './Input.props.ts';


export const Input = React.forwardRef<HTMLInputElement, InputProps>(({
	isValid = true, className, ...props
}, ref) => {
	return (
		<input {...props}
			ref={ref}
			className={cn(styles['input'], className, {
				[styles['invalid']]: isValid
			})}/>
	);
});