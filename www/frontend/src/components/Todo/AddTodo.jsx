import { useState } from 'react';
import {
	Button,
	FormControl,
	Input
} from '@chakra-ui/react';
import { useMutation } from '@apollo/client';
import { ALL_TODO } from '../../apollo/query/todo';
import { ADD_TODO} from '../../apollo/mutations/todo';

const AddTodo = () => {
	const [text, setText] = useState('');
	const [addTodo, {error}] = useMutation(ADD_TODO, {
		// ЗАГРУЖАЕТ СРАЗУ ВСЕ
		// refetchQueries: [
		//   { query: ALL_TODO }
		// ],

		// метод обновления кэша
		update(cache, { data: { newTodo } }) {
			const { todos } = cache.readQuery({ query: ALL_TODO });

			cache.writeQuery({
				query: ALL_TODO,
				data: {
					todos: [newTodo, ...todos]
				}
			});
		}
	});

	const handleAddTodo = () => {
		if (text.trim().length) {
			addTodo({
				variables: {
					title: text,
					completed: false,
					userId: 123
				}
			});
			setText('');
		}
	};

	const handleKey = (event) => {
		if (event.key === 'Enter') handleAddTodo();
	};

	if (error) {
		return <h2>Error...</h2>;
	}

	return (
		<FormControl display={'flex'} mt={6}>
			<Input
				value={text}
				onChange={(e) => setText(e.target.value)}
				onKeyPress={handleKey}
			/>
			<Button onClick={handleAddTodo}>Add task</Button>
		</FormControl>
	);
};

export default AddTodo;