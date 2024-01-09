import Rating from '@mui/material/Rating';
import {
  render,
  useState,
  useEffect
} from '@wordpress/element';
import apiFetch from '@wordpress/api-fetch';

function RecipeRating (props) {
  console.log(props);
  const [avgRating, setAvgRating] = useState(props.avgRating);
  const [permission, setPermission] = useState(props.loggedIn);

  useEffect(() => {
    if(props.ratingCount) {
      setPermission(false);
    }
  }, []);

  return (
    <Rating
      name="recipe-rating"
      value={avgRating}
      precision={0.5}
      onChange={async (e, rating) => {
        if (!permission) {
          return alert('You must be logged in to rate a recipe, or you may have already rated this recipe.');
        }

        setPermission(false);

       const response = await apiFetch({
          path: 'bwd/v1/rate',
          method: 'POST',
          data: {
            postID: props.postID,
            rating
          }
        });

        if (response.status == 1) {
          setAvgRating(response.data.avgRating);
        } else {
          alert(response.message);
        }
      }}
    />
  )
};  

document.addEventListener( 'DOMContentLoaded', () => {
  const block = document.querySelector('#recipe-rating');
  const postID = parseInt(block.dataset.postId);
  const avgRating = parseFloat(block.dataset.avgRating);
  const loggedIn = !!block.dataset.loggedIn;
  const ratingCount = !!parseInt(block.dataset.ratingCount);

  render(
    <RecipeRating 
      postID={postID}
      avgRating={avgRating}
      loggedIn={loggedIn}
      ratingCount={ratingCount}
    />,
    block
  )
});