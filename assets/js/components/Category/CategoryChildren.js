import { fetchCategories } from './service/categories-service';
import CategoryItem from './CategoryItem';
import CategoryItemOption from './CategoryItemOption';

const {
    useState,
    useEffect
} = wp.element;

function CategoryChildren( propos ) {
    const [ categories, setCategories ] = useState([]);
    const [ loading, setLoading ] = useState( false );
    const categoryId = propos.catId;
    const { mainCategory } = propos;
    const allItem = { name: 'Tout', id: mainCategory, active: true };

    async function loadCategories() {
        setLoading( true );
        let response;
        try {
            response = await fetchCategories( propos.siteSlug, categoryId );
            setCategories([
                {
                    name: 'Tout', id: 0, description: '', active: true
                },
                {
                    name: 'Information générale',
                    id: mainCategory,
                    active: false
                },
                ...response.data
            ]);
            setLoading( false );
        } catch ( e ) {
            setLoading( false );
        }
        return null;
    }

    useEffect( () => {
        if ( 0 < categoryId ) {
            loadCategories();
        }
    }, [ categoryId ]);

    function setItemActive( idCat ) {
        categories.map( ( object ) => {
            if ( object.id === idCat ) {
                return Object.assign( object, { active: true });
            }
            return Object.assign( object, { active: false });
        });
    }

    const listItems = categories.map( ( object ) => (
        <CategoryItem
            item={object}
            key={object.id}
            setItemActive={setItemActive}
            setSelectedCategory={propos.setSelectedCategory}
        />
    ) );

    function changeSelectedCategory( event ) {
        const categorySelectedId = event.target.value;
        setItemActive( categorySelectedId );
        propos.setSelectedCategory( categorySelectedId );
    }

    const options = categories.map( ( object ) => (
        <CategoryItemOption
            item={object}
            key={object.id}
        />
    ) );

    if ( 0 === categories.length ) {
        return ( <></> );
    }
    return (
        <>
            <div className="d-lg-none pr-12px border border-dark-primary mt-48px">
                <select
                    id="cat-select"
                    name="categories"
                    value={categoryId}
                    className="fs-short-3 ff-semibold"
                    onChange={changeSelectedCategory}
                >
                    { options }
                </select>
            </div>
            <div className="d-none d-lg-block overflow-hidden w-100 pt-48px col-6 px-0">
                <ul className="object-tags">
                    {listItems}
                </ul>
            </div>
        </>
    );
}

export default CategoryChildren;
