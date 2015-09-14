This behavior adds nicely formated time to your model find results.

## Set up:

1.Download the zip

2.Place "NiceTimeBehavior.php" in app/Model/Behavior

3.Open the file and specify which fields should be modified in nice time format (default)

	$this->fields = array('created','modified');

4.The behavior will add new fields "created_nice" and "modified_nice" with formated datetime,

5.Go to app/Model, open models with fields that should be formated in nice time, add the "NiceTime" Behaviour to the array or paste this code:

    public $actsAs = array('NiceTime');

## Example

Use $model['Model']['field_name_nice'] to display the date/time in nice format

```
<? echo Message sent '.$model['Model']['field_name_nice']; ?>
```

Would display:

```
"Message sent 2 hours ago."
```
or
```
"Message sent just now."
```