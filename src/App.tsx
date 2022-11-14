import React from 'react';
import TinderCard from 'react-tinder-card';
import SwipePage from './pages/SwipePage';

function App() {

  const onSwipe = (direction: any) => {
    console.log('You swiped: ' + direction)
  }
  
  const onCardLeftScreen = (myIdentifier: any) => {
    console.log(myIdentifier + ' left the screen')
  }

  return (
    <div>
      
      <SwipePage/>

    </div>
  );
}

export default App;
