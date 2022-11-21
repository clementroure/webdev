import React, { useState, useMemo, useRef } from 'react'
import TinderCard from 'react-tinder-card'
import { v4 as uuidv4 } from 'uuid';
import img1 from "../images/1.jpg"
import img2 from "../images/2.jpg"
import img3 from "../images/3.jpg"
import img4 from "../images/4.jpg"
import img5 from "../images/5.jpg"

function SwipePage(){

  // resize
  const [height, setHeight] = useState(window.innerHeight-2)
  const documentHeight = () => {
      setHeight(window.innerHeight-2)
  }
  window.addEventListener('resize', documentHeight)

  // variables
  const [users, setUsers] = useState<{username: string, description: string, picture: string, rotation: number}[]>([{username: "Thomas", description:"bla bla", picture:img1,  rotation: (Math.random() * (5 - -5) + -5),},{username: "Thomas", description:"bla bla", picture:img2, rotation: (Math.random() * (5 - -5) + -5)},{username: "Thomas", description:"bla bla", picture:img3, rotation: (Math.random() * (5 - -5) + -5)},{username: "Thomas", description:"bla bla", picture:img4, rotation: (Math.random() * (5 - -5) + -5)},{username: "Thomas", description:"bla bla", picture:img5, rotation: (Math.random() * (5 - -5) + -5)}])

  // methods
  const onSwipe = (direction:any) => {
    console.log('You swiped: ' + direction)
  }
  
  const onCardLeftScreen = (myIdentifier:any) => {
     console.log(myIdentifier + ' left the screen')
  }

  return (
    <div className='w-screen items-center justify-center bg-[#030017]'>
      <div className='grid max-w-3xl border-x-2 border-gray-800 bg-gray-900 w-full h-screen place-items-center overflow-hidden relative left-1/2 -translate-x-1/2' style={{height: height}}>
          {users?.map(function(user: any, index: number) {
          return <TinderCard className='absolute' onSwipe={onSwipe} onCardLeftScreen={() => onCardLeftScreen('fooBar')} swipeThreshold={0.175} key={uuidv4()}>
                <div style={{transform: `rotate(${user?.rotation}deg)`}} className="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <img className="rounded-t-lg pointer-events-none w-80 h-80 object-cover" src={user.picture} alt=""/>
                    <div className="p-5">
                        <h5 className="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{user.username}</h5>
                        <p className="mb-3 font-normal text-gray-700 dark:text-gray-400">{user.description}</p>
                    </div>
                  </div>
                  </TinderCard>
                  })
                }
      </div>
    </div>
  );
}

export default SwipePage