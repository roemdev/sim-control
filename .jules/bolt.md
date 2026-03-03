## 2024-03-03 - [Prevent Unnecessary Eloquent Side-Effects in Saved Event]
**Learning:** In Laravel Eloquent, the `saved` event triggers on both creation and updates. If a model has a side-effect (like recalculating a parent's aggregated value) attached to `saved`, it will run even if irrelevant fields are updated.
**Action:** Next time, split `saved` into `created` and `updated`. Use `$model->wasChanged(['field1', 'field2'])` in the `updated` event to ensure expensive recalculations or side-effects only run when the relevant fields are actually modified.
