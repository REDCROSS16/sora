import Button from './components/Button/Button.tsx';
import React, {useEffect, useState, MouseEvent} from 'react';
import {Input} from './components/Input/Input.tsx';

function App() {

	const [counter, setCounter] = useState<number>(0);

	useEffect(() => {

	}, []);

	const addCounter = (e: MouseEvent) => {
		console.log('hello');
	};

	return (
		<>
			<Button appearance='small' onClick={addCounter}>
                hello
			</Button>
			<Button appearance='big' children={'test text'}/>
			<Input placeholder='Email'/>
		</>
	);
}

export default App;
