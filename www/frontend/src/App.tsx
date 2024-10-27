import Button from './components/Button/Button.tsx';
import React, {useEffect, useState, MouseEvent} from 'react';

function App() {

	const [counter, setCounter] = useState<number>(0);

	useEffect(() => {

	}, []);

	const addCounter = (e: MouseEvent) => {
		setCounter('asd');  

		console.log(e);
	};

	return (
		<>
			<Button appearance='asda' onClick={addCounter}>
                hello
			</Button>
		</>
	);
}

export default App;
